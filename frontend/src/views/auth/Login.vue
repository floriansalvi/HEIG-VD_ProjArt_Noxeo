<template>
  <div class="login-page">
    <div class="login-header">
      <img
        src="@/assets/ecusson-bleague-yellow.png"
        alt="B League Logo"
        class="logo"
      />
    </div>

    <div class="login-form">
      <input type="text" placeholder="user id" class="input" />

      <div class="input-wrapper">
        <input type="password" placeholder="password" class="input" />
        <a href="#" class="forgot">Forgot ?</a>
      </div>
    </div>

    <div class="login-footer">
      <button class="btn btn-primary">Log in</button>
      <p class="signup-link">
        <router-link to="/register">I don’t have an account yet</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
// Future: v-model, emits, etc.
</script>

<style scoped>
.login-page {
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  justify-content: flex-start;
  background-color: var(--color-white);
}

/* Header logo zone */
.login-header {
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

/* Form inputs */
.login-form {
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

/* Input wrapper with forgot link */
.input-wrapper {
  position: relative;
}

.input-wrapper .input {
  width: 100%;
}

.forgot {
  position: absolute;
  right: var(--space-sm);
  top: 50%;
  transform: translateY(-50%);
  font-size: 0.85rem;
  color: var(--color-gray);
  text-decoration: none;
}

/* Footer with button */
.login-footer {
  padding: var(--space-lg);
  max-width: 400px;
  margin: 0 auto;
  width: 100%;
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

.signup-link {
  text-align: center;
  font-size: 0.85rem;
  margin-top: var(--space-sm);
}

.signup-link a {
  color: var(--color-blue);
  text-decoration: none;
  font-weight: var(--font-medium);
}

/* Responsive breakpoints */
@media (min-width: 768px) {
  .login-header {
    padding: 80px 0;
  }

  .login-form,
  .login-footer {
    max-width: 480px;
  }
}

@media (min-width: 1024px) {
  .login-page {
    align-items: center;
    justify-content: center;
  }

  .login-form,
  .login-footer {
    max-width: 500px;
  }
}
</style>
