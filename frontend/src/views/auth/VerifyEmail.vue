<script setup>
import { ref } from 'vue'
import axios from 'axios'
import auth from '@/services/auth'
import { useRouter } from 'vue-router'

const router = useRouter()

const code = ref('')
const error = ref('')
const loading = ref(false)

const verifyCode = async () => {
  loading.value = true
    try {

    await auth.verifyEmailCode(code.value);
    await auth.fetchUser()
    router.push('/learning-path')

  } catch (err) {
    error.value = 'Invalid or expired code'
    loading.value = false
  }
  loading.value = false
}

const resendCode = async () => {
  loading.value = true
    try {
    const res = await auth.resendVerificationEmail()
    error.value = ''
  } catch (err) {
    console.log(err)
    error.value = 'Could not resend code. Please try again.'
    loading.value = false
  }
  loading.value = false
}
</script>

<template>
  <div style="padding: 2rem">
    <h1>Verify your email</h1>
    <p>We’ve sent you a code. Please check your inbox and enter the code below.</p>

    <form @submit.prevent="verifyCode">
      <input
        v-model="code"
        type="text"
        placeholder="Enter the 6-digit code"
        maxlength="6"
        required
      />
      <button type="submit">Verify</button>
    </form>

    <p v-if="error" style="color: red">{{ error }}</p>

    <button @click="resendCode" style="margin-top: 1rem">Resend code</button>
  </div>
</template>