import Token from './Token';
import AppStorage from './AppStorage';

class User {
  responseAfterLogin(res) {
    const access_token = res.data.access_token;
    const username = res.data.user;

    if (Token.isValid(access_token)) {
      AppStorage.store(username, access_token);
    }
  }

  hasToken() {
    const storedToken = AppStorage.getToken();

    if (storedToken) {
      return Token.isValid(storedToken) ? true : this.logoutToLogin();
    }

    return false;
  }

  loggedIn() {
    return this.hasToken();
  }

  logout() {
    AppStorage.clear();
    window.location = '/forum';
  }

  logoutToLogin() {
    AppStorage.clear();
    window.location = '/login';
  }

  name() {
    if (this.loggedIn()) {
      return AppStorage.getUser();
    }
  }

  id() {
    if (this.loggedIn()) {
      const payload = Token.payload(AppStorage.getToken());

      return payload.sub;
    }
  }

  own(id) {
    return parseInt(this.id()) === parseInt(id);
  }

  isAdmin() {
    return parseInt(this.id()) === 8;
  }
}

export default User = new User();
