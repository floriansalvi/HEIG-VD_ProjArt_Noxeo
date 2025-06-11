<template>
  <div class="help-page">
    <AppHeader @menu="toggleMenu" />
    <AppMenu :show="menuVisible" @close="menuVisible = false" />

    <div class="content">
      <h1 class="title-xl">Help</h1>

      <section>
        <h2 class="title-lg">The Breitling League</h2>

        <h3 class="title-md">What is the Breitling League?</h3>
        <p class="text-body">
          The Breitling League is an interactive learning experience for retail partners. It helps you sharpen your knowledge of the brand and its collections, while earning points and climbing the leaderboard.
        </p>

        <h3 class="title-md">Why participate?</h3>
        <p class="text-body">
          Because knowledge is power — and your ticket to the Breitling Cup. Complete modules, earn points, and reach the top 16 in your market to qualify.
        </p>
      </section>

      <section>
        <h2 class="highlight-block">How it works</h2>
        <ol class="steps">
          <li>
            <strong>1. Learn</strong>
            <p>Complete short, focused lessons covering the brand and products.</p>
          </li>
          <li>
            <strong>2. Test yourself</strong>
            <p>Take quizzes after each lesson. Score 60% or more — speed counts!</p>
          </li>
          <li>
            <strong>3. Earn points</strong>
            <p>Points come from:
              <ul>
                <li>Correct answers</li>
                <li>Test speed</li>
                <li>Bonus challenges</li>
              </ul>
              Your score determines your leaderboard rank.
            </p>
          </li>
        </ol>
      </section>

      <section class="info-box">
        <h3 class="title-md">The Breitling Cup awaits</h3>
        <p class="text-body">
          The top 16 performers join teams for the final tournament: the Breitling Cup — a challenge of skill, knowledge, and team spirit.
        </p>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import AppHeader from '@/layouts/AppHeader.vue'
import AppMenu from '@/layouts/AppMenu.vue'

const menuVisible = ref(false)
const toggleMenu = () => (menuVisible.value = !menuVisible.value)
</script>

<style scoped>
.help-page {
  background: #fff;
  min-height: 100vh;
  padding-top: 80px;
}

.content {
  padding: 24px;
  max-width: 600px;
  margin: 0 auto;
}

.highlight-block {
  background: #ffc72c;
  padding: 0.6rem 0.8rem;
  font-weight: bold;
  border-radius: 4px;
  margin-top: 2rem;
  font-size: 1.1rem;
}

.steps {
  list-style: none;
  padding: 0;
  margin-top: 1rem;
}

.steps li {
  margin-bottom: 1.5rem;
}

.steps ul {
  padding-left: 1.2rem;
  list-style: disc;
}

.info-box {
  background: #fff8e1;
  border: 1px solid #ffd24d;
  padding: 1rem;
  border-radius: 6px;
  margin-top: 2rem;
}
</style>
