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
      <div class="input-row">
        <input type="text" placeholder="surname" class="input" />
        <input type="text" placeholder="name" class="input" />
      </div>

      <input type="text" placeholder="nickname" class="input" />
      <input type="email" placeholder="email" class="input" />
      <input type="url" placeholder="personal website" class="input" />
      <input type="password" placeholder="password" class="input" />
      <input
        type="password"
        placeholder="password confirmation"
        class="input"
      />

      <label class="checkbox-container">
        <input type="checkbox" />
        <span>
          I agree to the
          <a href="#" target="_blank">terms of service</a>
          and
          <a href="#" target="_blank">privacy policy</a>
        </span>
      </label>

      <button class="btn btn-primary">
        <router-link to="/home">Save</router-link>
      </button>

      <p class="login-link">
        <router-link to="/">I already have an account</router-link>
      </p>
    </div>
  </div>
</template>

<script setup>
// ready for v-model binding
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
  max-width: 500px;
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

/* Row for surname + name */
.input-row {
  display: flex;
  gap: var(--space-sm);
}

.input-row .input {
  flex: 1;
}

/* Checkbox */
.checkbox-container {
  display: flex;
  align-items: flex-start;
  gap: var(--space-sm);
  font-size: 0.9rem;
  line-height: 1.4;
  color: var(--color-black);
}

.checkbox-container input {
  margin-top: 4px;
}

.checkbox-container a {
  text-decoration: underline;
  color: var(--color-blue);
}

/* Button */
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

/* Link */
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
    max-width: 520px;
  }
}
</style>
