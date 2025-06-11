<script setup>
import { ref, reactive, onMounted, inject, defineProps } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'
import auth from '@/services/auth'

const $http = inject('$http');

const props = defineProps({
    testId: String
})

const started = ref(false)
const finished = ref(false)
const loading = ref(false)
const currentIndex = ref(0)
const score = ref(0)
const bonusTime = ref(0)
const totalScore = ref(0)
const result = ref('')
const selectedChoiceId = ref(null)
const feedback = ref(null)
const timer = ref(0)
const maxTime = ref(0)
const intervalId = ref(null)
const stepId = ref(null)
const questionText = ref('')

const test = reactive({
    questions: []
})

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const fetchTest = async () => {
    loading.value = true
    try {
        await $http.get('/sanctum/csrf-cookie')
        const response = await $http.get(`api/v1/tests/${props.testId}`)
        
        test.questions = response.data.data.test_questions
        stepId.value = response.data.data.step.id
        maxTime.value = response.data.data.step.max_time
        timer.value = maxTime.value
        
        loading.value = false

    } catch (err) {
        console.log(err.message)
    }
}

const startTest = () => {
    started.value = true
    intervalId.value = setInterval(() => {
        timer.value--
        if (timer.value <= 0) {
            clearInterval(intervalId.value)
            finishTest()
        }
    }, 1000);
}

const answer = (choice) => {
    if (feedback.value) return

    selectedChoiceId.value = choice.id
    const question = test.questions[currentIndex.value]
    const isCorrect = choice.is_correct

    feedback.value = isCorrect ? 'correct' : 'wrong'

    if (isCorrect) {
        score.value += question.points_awarded
    }

    setTimeout(() => {
        feedback.value = null
        selectedChoiceId.value = null
        nextQuestion()
    }, 3000);
}

const nextQuestion = () => {
    if (currentIndex.value < test.questions.length - 1) {
        currentIndex.value++
    } else {
        finishTest()
    }
}

const finishTest = async () => {
    clearInterval(intervalId.value)

    const percentCorrect = score.value / (test.questions.length * 1000)
    const success = timer.value > 0 && percentCorrect >= 0.6

    if (success) {
        bonusTime.value = Math.floor((timer.value / maxTime.value) * score.value)
        totalScore.value = score.value + bonusTime.value
        result.value = 'Success'
    } else {
        result.value = 'Missed'
    }

    try {
        await $http.get('/sanctum/csrf-cookie')
        await $http.post('/api/v1/test-progress', {
        'step_id': stepId.value,
        'test_id': props.testId,
        'attempt_date': new Date().toISOString().split('T')[0],
        'score': score.value,
        'time_bonus': bonusTime.value,
        'is_successful': result.value === 'Success',
    })

    finished.value = true

    } catch (err) {
        console.error('=== ERROR DETAILS ===');
        console.error('Message:', err.message);
        console.error('Status:', err.response?.status);
        console.error('Status Text:', err.response?.statusText);
        console.error('Response Data:', err.response?.data);
        console.error('Full Error Object:', err);
    }
}

onMounted(fetchTest)

</script>

<template>
    <div class="test-page">
        <AppHeader @menu="toggleMenu" />
        <AppMenu :show="menuVisible" />
        <main v-if="!loading" class="test-page-main">
            <p v-if="started && !finished">{{ timer }}s</p>
            <div class="test-content">
                <h2 v-if="!started">Test</h2>
                <h2 v-if="started">Question {{ currentIndex + 1 }}</h2>
                <button v-if="!started" @click="startTest" class="start-btn">Start</button>

                <div v-if="started && !finished">
                    <p>{{ test.questions[currentIndex].content }}</p>

                    <div class="choices">
                        <div
                            v-for="choice in test.questions[currentIndex].choices"
                            :key="choice.id"
                            class="choice"
                            :class="{
                                correct: feedback === 'correct' && choice.is_correct,
                                wrong: feedback === 'wrong' && choice.id === selectedChoiceId
                            }"
                            @click="answer(choice)"
                        >
                            <img v-if="choice.choiceable_type === 'App\\Models\\ImageChoice'" :src="'/img/test/' + choice.choiceable.img_path" :alt="choice.choiceable.alt_txt" />
                            <span v-if="choice.choiceable_type === 'App\\Models\\TextChoice'">{{ choice.choiceable.content }}</span>
                        </div>
                    </div>
                </div>
                <div v-if="finished">
                    <h2>{{ result }}</h2>
                    <p>Score : {{ score }} PTS</p>
                    <p>Time bonus : {{ bonusTime }} PTS</p>
                    <p>Total : {{ totalScore }} PTS</p>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>
.test-page {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    min-height: 100vh;
    padding-top: 80px; /* leave space for header */
}

.test-page-main {
  padding: 24px 16px;
}

main {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    background-color: #fafafa;
}

.test-content {
    width: 50vw;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.start-btn {
    width: 50%;
    max-width: 320px;
    flex: 1;
    padding: 12px 0;
    background-color: var(--color-black);
    color: #fff;
    border: none;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: ease-in-out 0.2s;
}

.start-btn:hover {
   background-color: var(--color-yellow); 
}

</style>