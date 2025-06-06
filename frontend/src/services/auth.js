import { ref } from "vue";
import axiosClient from "../axios";

const user = ref(null);
const isAuthenticated = ref(false);
const emailVerified = ref(false);

/**
 * Fetches the currently authenticated user data from the API.
 * @returns {Promise<void>}
 */
async function fetchUser() {
    try {
        const { data } = await axiosClient.get('/api/user');

        user.value = data;
        isAuthenticated.value = true;
        emailVerified.value = !!data.is_mail_confirmed; // Check email verification

    } catch (error) {
        user.value = null;
        isAuthenticated.value = false;
        emailVerified.value = false;
    }
}

/**
 * Logs in a user with the given email and password.
 * @param {string} email
 * @param {string} password
 * @returns {Promise<void>}
 */
async function login(login, password) {
    await axiosClient.get('/sanctum/csrf-cookie');
    await axiosClient.post('/login', { login, password });
    await fetchUser();
}

async function registerUser(data) {
    await axiosClient.get('/sanctum/csrf-cookie')
    return await axiosClient.post('/register', data)
}

/**
 * Logs out the current user.
 * @returns {Promise<void>}
 */
async function logout() {
    await axiosClient.post('/logout');
    user.value = null;
    isAuthenticated.value = false;
    emailVerified.value = false;
}

/**
 * Submits a registration key to validate access to registration.
 * @param {string} key
 * @returns {Promise<Object>} market_id & key data
 */
async function submitRegistrationKey(key) {
  const response = await axiosClient.get(`/api/v1/registration-key/${key}`);
  return response.data.data;
}

/**
 * Sends email verification request (resend link)
 * @returns {Promise<void>}
 */
async function resendVerificationEmail() {
    await axiosClient.post('/api/v1/user/verify/resend');
}

/**
 * Submits the verification code to verify email
 * @param {string} code
 * @returns {Promise<void>}
 */
async function verifyEmailCode(code) {
    await axiosClient.post('/api/v1/user/verify', { key: code });
    await fetchUser(); // Refresh after verification
}

export default {
    user,
    isAuthenticated,
    emailVerified,
    fetchUser,
    registerUser,
    login,
    logout,
    submitRegistrationKey,
    resendVerificationEmail,
    verifyEmailCode,
};
