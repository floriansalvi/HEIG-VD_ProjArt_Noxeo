<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import auth from '@/services/auth.js'

const router = useRouter()

const code = ref('')
const error = ref('')
const loading = ref(false)

const verifyCode = async () => {
  loading.value = true
  try {
    await auth.verifyEmailCode(code.value)
    await auth.fetchUser()
    router.push('/learning-path')
  } catch (err) {
    error.value = 'Invalid or expired code'
  } finally {
    loading.value = false
  }
}

const resendCode = async () => {
  loading.value = true
  try {
    await auth.resendVerificationEmail()
    error.value = ''
  } catch (err) {
    error.value = 'Could not resend code. Please try again.'
  } finally {
    loading.value = false
  }
}
</script>

<template>
  <div class="verification-page">
    <div class="verification-header">
      <img
        src="@/assets/ecusson-bleague-yellow.png"
        alt="B League Logo"
        class="logo"
      />
    </div>

    <form class="verification-form" @submit.prevent="verifyCode">
      <h1 class="title">Verify your email</h1>
      <p class="subtitle">
        We’ve sent you a code. Please check your inbox and enter it below.
      </p>

      <input
        v-model="code"
        type="text"
        maxlength="6"
        placeholder="Enter the 6-digit code"
        class="input"
        required
      />

      <p v-if="error" class="error-text">{{ error }}</p>

      <button
        class="btn btn-primary"
        type="submit"
        :disabled="loading"
      >
        <span v-if="loading">Verifying...</span>
        <span v-else>Verify</span>
      </button>

      <button
        class="btn btn-secondary"
        type="button"
        @click="resendCode"
        :disabled="loading"
      >
        Resend Code
      </button>
    </form>
  </div>
</template>

<style scoped>
.verification-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  background-color: var(--color-white);
}

/* Header with logo */
.verification-header {
  background-color: var(--color-blue);
  width: 100%;
  padding: 64px 0;
  display: flex;
  justify-content: center;
}

.logo {
  width: 160px;
  max-width: 70%;
  height: auto;
}

/* Form styling */
.verification-form {
  flex: 1;
  display: flex;
  flex-direction: column;
  gap: var(--space-md);
  padding: var(--space-lg);
  max-width: 400px;
  width: 100%;
  margin: 0 auto;
  box-sizing: border-box;
}

.title {
  font-size: 1.5rem;
  font-weight: bold;
  margin-bottom: 0.5rem;
}

.subtitle {
  font-size: 1rem;
  margin-bottom: 1rem;
}

.input {
  width: 100%;
  padding: var(--space-sm);
  font-size: 1rem;
  border: 1px solid black;
  font-family: var(--font-family-main);
  box-sizing: border-box;
}

.error-text {
  color: red;
  font-size: 0.9rem;
}

.btn-primary {
  width: 100%;
  background-color: black;
  color: white;
  padding: var(--space-sm);
  font-size: 1rem;
  font-family: var(--font-family-main);
  border: none;
  cursor: pointer;
}

.btn-secondary {
  width: 100%;
  background-color: transparent;
  color: var(--color-blue);
  padding: var(--space-sm);
  font-size: 0.95rem;
  border: none;
  text-decoration: underline;
  cursor: pointer;
}

/* Responsive tweaks */
@media (min-width: 768px) {
  .verification-header {
    padding: 80px 0;
  }

  .verification-form {
    max-width: 480px;
  }
}

@media (min-width: 1024px) {
  .verification-page {
    align-items: center;
    justify-content: center;
  }

  .verification-form {
    max-width: 500px;
  }
}
</style>
