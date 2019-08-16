import axios from 'axios';
import User from './helpers/User';

export default () => {
  axios.interceptors.response.use((response) => {
    return response;
  }, function(error) {
    if (error.response.data && error.response.data.error && error.response.data.error === 'Token is expired') {
      User.logoutToLogin();
    }
    return Promise.reject(error.response);
  });
};
