<template>
  <div class="register-page">
    <div class="register-header">
      <img
        src="@/assets/ecusson-bleague-yellow.png"
        alt="B League Logo"
        class="logo"
      />
    </div>

    <div class="register-form">
      <input type="text" placeholder="key access" class="input" />

      <button class="btn btn-primary">
        <router-link to="/register-step-2">Continue</router-link>
      </button>

      <p class="login-link">
        <router-link to="/">I already have an account</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
// Future use: emits, navigation, validation, etc.
</script>

<style scoped>
.register-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  background-color: var(--color-white);
}

.register-header {
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

.register-form {
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

.input {
  width: 100%;
  padding: var(--space-sm);
  font-size: 1rem;
  border: 1px solid black;
  font-family: var(--font-family-main);
  border-radius: 4px;
  box-sizing: border-box;
}

.btn-primary {
  width: 100%;
  background-color: black;
  color: white;
  padding: var(--space-sm);
  font-size: 1rem;
  font-family: var(--font-family-main);
  border: none;
  border-radius: 6px;
  cursor: pointer;
}

.login-link {
  text-align: center;
  font-size: 0.85rem;
  margin-top: var(--space-sm);
}

.login-link a {
  color: var(--color-blue);
  text-decoration: none;
  font-weight: var(--font-medium);
}

/* Responsive */
@media (min-width: 768px) {
  .register-header {
    padding: 80px 0;
  }

  .register-form {
    max-width: 480px;
  }
}

@media (min-width: 1024px) {
  .register-page {
    align-items: center;
    justify-content: center;
  }

  .register-form {
    max-width: 500px;
  }
}
</style>
