<script setup>
import { ref, reactive, onMounted, inject, defineProps } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'
import { useRouter } from 'vue-router'
import auth from '@/services/auth'

const $http = inject('$http');

const router = useRouter() 

const props = defineProps({
    testId: String
})

const started = ref(false)
const finished = ref(false)
const loading = ref(false)
const submitting = ref(false)
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
const moduleTitle = ref('')

const canStartTest = ref(false);
const alreadyAttemptedToday = ref(false);
const alreadySucceeded = ref(false);
const errMessage = ref('')

const test = reactive({
    questions: []
})

const menuVisible = ref(false)
function toggleMenu() {
  menuVisible.value = !menuVisible.value
}

const checkTestProgress = async () => {
    try {
        const response = await $http.get(`api/v1/test-progress/${props.testId}`)

        const today = new Date().toISOString().split('T')[0]

        const attempt = response.data.data || {}

        alreadySucceeded.value = !!attempt.is_successful
        alreadyAttemptedToday.value = attempt.attempt_date ? attempt.attempt_date.startsWith(today) : false

        if (alreadySucceeded.value) {
            errMessage.value = "This test is already succeeded."
            canStartTest.value = false
        } else if (alreadyAttemptedToday.value) {
            errMessage.value = "Daily attempt already used. Please try again tomorrow."
            canStartTest.value = false
        } else {
            canStartTest.value = true
        }


    } catch (err) {
        console.error(err);
        canStartTest.value = true
    }
}

const fetchTest = async () => {
    loading.value = true
    try {
        await $http.get('/sanctum/csrf-cookie')
        await checkTestProgress()
        const response = await $http.get(`api/v1/tests/${props.testId}`)

        moduleTitle.value = response.data.data.step.module.title
        test.questions = response.data.data.test_questions
        stepId.value = response.data.data.step.id
        maxTime.value = response.data.data.step.max_time
        timer.value = maxTime.value
        
        loading.value = false

    } catch (err) {
        console.log(err.message)
        await router.push('/error')
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
    
    submitting.value = true

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
        submitting.value = false
        nextQuestion()
    }, 1000);
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
        result.value = 'Test validated'
    } else {
        result.value = 'Test failed'
    }

    try {
        await $http.get('/sanctum/csrf-cookie')
        await $http.post('/api/v1/test-progress', {
        'step_id': stepId.value,
        'test_id': props.testId,
        'attempt_date': new Date().toISOString().split('T')[0],
        'score': score.value,
        'time_bonus': bonusTime.value,
        'is_successful': result.value === 'Test validated',
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

const nextStep = () => {
    router.push('/')
}

const backToPath = () => {
    router.push('/learning-path')
}

onMounted(fetchTest)

</script>

<template>
    <div class="test-page">
        <AppHeader @menu="toggleMenu" />
        <AppMenu :show="menuVisible" />
        <main v-if="!loading" class="test-page-main">
            <div class="test-content">
                <h1
                v-if="!finished"
                :class="{'start-title': started === false && finished === false}"
                >{{'Test - ' + moduleTitle}}</h1>
                <div v-if="started && !finished" class="timing">
                    <div class="progress-bar">
                        <div 
                            v-for="(q, index) in test.questions.length"
                            :key="index"
                            class="segment"
                            :class="{ filled: index < currentIndex }"
                        >
                        </div>
                    </div>
                    <p>{{ Math.floor(timer / 60) }}:{{ (timer % 60).toString().padStart(2, '0') }}</p>
                    <img :src="'/img/hourglass.svg'" alt="hourglass" class="hourglass-icon">
                </div>
            
                <p v-if="started && !finished">Choose the correct answer</p>
                <p v-if="!canStartTest" class="msg-error">{{ errMessage }}</p>
                <h2 v-if="started && !finished">{{ currentIndex + 1 }}. {{ test.questions[currentIndex].content }}</h2>
                <button
                    v-if="!started"
                    @click="canStartTest ? startTest() : backToPath()"
                    class="start-btn"
                >
                    {{ canStartTest ? 'Start' : 'Back to the path'}}
                </button>

                <div v-if="started && !finished">
                    <div class="choices">
                        <div
                            v-for="choice in test.questions[currentIndex].choices"
                            :key="choice.id"
                            class="choice"
                            :class="{
                                correct: feedback === 'correct' && choice.is_correct,
                                'correct-border': feedback === 'wrong' && choice.is_correct,
                                wrong: feedback === 'wrong' && choice.id === selectedChoiceId,
                                disabled: submitting
                            }"
                            @click="answer(choice)"
                        >
                            <img v-if="choice.choiceable_type === 'App\\Models\\ImageChoice'" :src="'/img/test/' + choice.choiceable.img_path" :alt="choice.choiceable.alt_txt" />
                            <span v-if="choice.choiceable_type === 'App\\Models\\TextChoice'">{{ choice.choiceable.content }}</span>
                        </div>
                    </div>
                </div>
                <div v-if="finished" class="finished">
                    <h1>{{ result }}</h1>

                    <div class="score-section">
                        <div class="score-card">
                            <p>{{ score }} PTS</p>
                            <span>earnt</span>
                        </div>
                        <div class="score-card">
                            <p>{{ bonusTime }} PTS</p>
                            <span>time bonus</span>
                        </div>
                    </div>
                    <p class="total-score">Total : {{ totalScore }} PTS</p>
                    <div class="btn-div">
                        <button
                            class="back-path-btn"
                            @click="backToPath"
                        >
                            Back to the path
                        </button>
                        <button
                            v-if="result === 'Test validated'"
                            class="start-btn"
                            @click="nextStep"
                        >
                        Next
                        </button>
                        
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>

<style scoped>

.score-section {
    display: flex;
    flex-direction: row;
    gap: 24px;
}

.score-card {
    align-items: center;
    display: flex;
    flex-direction: column;
    gap: 4px;

    p {
        font-size: 24px;
        line-height: normal;
    }

    span {
        opacity: 75%;
        font-size: 16px;
        line-height: normal;
    }
}

.total-score {
    font-size: 24px;
}

.test-page {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #fff;
    min-height: 100vh;
    padding-top: 80px; /* leave space for header */
}

.test-page-main {
    width: 100%;
    max-width: 100vw;
    padding: 24px 16px;
    margin: 0 auto;
    box-sizing: border-box;
}

main {
    width: fit-content;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 12px;
}

.test-content {
    width: 100%;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    align-items: stretch;
    justify-content: center;
}

button {
    width: 100%;
}

.start-btn {
    flex: 1;
    padding: 12px 0;
    background-color: var(--color-black);
    color: #fff;
    border: none;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: ease-in-out 0.2s;
    margin: 0 auto;
}

.back-path-btn {
    box-sizing: border-box;
    flex: 1;
    padding: 12px 0;
    background-color: transparent;
    color: var(--color-black);
    border: 1px solid var(--color-black);
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: ease-in-out 0.2s;
    margin: 0 auto;
}

.back-path-btn:hover {
    border: 1px solid var(--color-yellow);
}

.btn-div {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.start-btn:hover {
   background-color: var(--color-yellow); 
}

.choices {
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.choice {
    width: 100%;
    border: 1px solid var(--color-black);
    box-sizing: border-box; /* AJOUTÉ pour inclure bordure dans la largeur */
    cursor: pointer; /* optionnel, pour montrer que c’est cliquable */
    padding: 12px; /* optionnel, pour un peu d’espace interne */
    display: flex;
    align-items: center;
    gap: 8px; /* espace entre image et texte */
}

.choice:hover {
    border: 1px solid var(--color-yellow);
}

.correct {
    border: 1px solid #a9dca5;
    background-color: #a9dca5;
}

.wrong {
    border: 1px solid #e2807d;
    background-color: #e2807d;
}

.correct-border {
  border: 2px solid #a9dca5;
}

.choice.disabled {
    pointer-events: none;
    cursor: not-allowed;

    &:hover {
        border: 1px solid var(--color-black);
    }
}

.timer-progress {
  width: 100%;
  margin-bottom: 16px;
}

.progress-bar {
  display: flex;
  flex: 1;
  width: 100%;
  height: 3px;
  gap: 6px;
  margin-top: 0;      
  margin-bottom: 0;
  align-self: center;
}

.segment {
  flex: 1;
  background-color: #e0e0e0;
  transition: background-color 0.3s;
}

.segment.filled {
  background-color: var(--color-yellow); /* ou une autre couleur */
}

.timing {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
}

.timing p, p {
    margin: 0;
}

.hourglass-icon {
  height: 18px;
  width: auto;
  animation: flipHourglass 2s linear infinite;
}

@keyframes flipHourglass {
  0%, 33.333% {
    transform: rotate(0deg);
  }
  66.666% {
    transform: rotate(180deg);
  }
  99.999% {
    transform: rotate(180deg);
  }
  100% {
    transform: rotate(0deg);
  }
}

h1 {
    margin: 0;
}

.start-title {
    margin: 16px auto;
}

.finished {
  width: 100%;
  display: flex;
  flex-direction: column;
  align-items: center; /* centre tous les enfants horizontalement */
  justify-content: center;
  gap: 24px; /* un peu d’espace entre les éléments */
  text-align: center; /* utile pour centrer le texte comme le titre ou le score */
}

.finished h1,
.finished .total-score,
.finished .score-section {
  width: 100%;
  max-width: 320px;
}

.finished .score-section {
  display: flex;
  flex-direction: row;
  gap: 24px;
  justify-content: center; /* centre les cartes de score */
}

.finished .score-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 4px;
}

.finished .btn-div {
  display: flex;
  flex-direction: column;
  gap: 16px;
  width: 100%;
  max-width: 320px;
}

.finished .btn-div button {
  width: 100%;
}

.msg-error {
    text-align: center;
    margin-bottom: 16px;
}

@media (min-width: 768px) {
  button {
    width: 50%;
    max-width: 320px;
  }

  .test-page-main {
    max-width: 50vw;
  }
}
</style>