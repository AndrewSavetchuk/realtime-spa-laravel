import Login from '../components/auth/Login';
import SignUp from '../components/auth/SignUp';
import Forum from '../components/Forum';

const ifNotAuthenticated = (to, from, next) => {
  if (!User.loggedIn()) {
    next();
    return;
  }
  next('/forum');
};

const ifAuthenticated = (to, from, next) => {
  if (User.loggedIn()) {
    next();
    return;
  }
  next('/login');
};

const displayTitle = (title) => {
  const websiteTitle = document.querySelector('title').textContent;
  return `${title} - ${websiteTitle}`;
};

const routes = [
  {
    path: '/login',
    component: Login,
    meta: {
      title: displayTitle('Login'),
    },
    beforeEnter: ifNotAuthenticated,
  },
  {
    path: '/signup',
    component: SignUp,
    meta: {
      title: displayTitle('Sign Up'),
    },
    beforeEnter: ifNotAuthenticated,
  },
  {
    path: '/forum',
    component: Forum,
    name: 'forum',
    meta: {
      title: displayTitle('Forum'),
    },
  },
];

export default routes;
