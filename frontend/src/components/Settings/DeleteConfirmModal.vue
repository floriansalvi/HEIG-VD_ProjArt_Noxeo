<template>
  <div class="modal-overlay" @click.self="$emit('close')">
    <div class="modal">
      <h2>Delete your account?</h2>
      <p>This action is irreversible. Are you sure you want to continue?</p>
      <div class="actions">
        <button class="cancel" @click="$emit('close')">Cancel</button>
        <button class="confirm" @click="$emit('confirm')">Yes, delete</button>
      </div>
    </div>
  </div>
</template>

<script setup>
defineEmits(['close', 'confirm'])
</script>

<style scoped>
.modal-overlay {
  position: fixed;
  inset: 0;
  background: rgba(0, 0, 0, 0.4);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 100;
}
.modal {
  background: white;
  padding: 24px;
  border-radius: 12px;
  width: 90%;
  max-width: 340px;
  text-align: center;
}
.actions {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}
.cancel {
  background: none;
  border: 1px solid #999;
  padding: 10px 16px;
  border-radius: 6px;
  cursor: pointer;
}
.confirm {
  background: red;
  color: white;
  border: none;
  padding: 10px 16px;
  border-radius: 6px;
  cursor: pointer;
}
</style>
