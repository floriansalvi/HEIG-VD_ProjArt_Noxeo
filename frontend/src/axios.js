import axios from 'axios'

/**
 * Create an axios client instance with default configuration.
 */
const axiosClient = axios.create({
    baseURL: 'http://localhost:8000',
    withCredentials: true,
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
    },
})

/**
 * Axios request interceptor to attach CSRF token from cookies to request headers.
 * @param {import('axios').AxiosRequestConfig} config - The Axios request configuration.
 * @returns {import('axios').AxiosRequestConfig} The modified Axios request configuration.
 */
axiosClient.interceptors.request.use((config) => {
    const xsrfToken = document.cookie
      .split('; ')
      .find((row) => row.startsWith('XSRF-TOKEN='))
      ?.split('=')[1]
  
    if (xsrfToken) {
      config.headers['X-XSRF-TOKEN'] = decodeURIComponent(xsrfToken)
    }
  
    return config
  })
  
  export default axiosClient