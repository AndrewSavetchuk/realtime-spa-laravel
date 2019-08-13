import Login from '../components/auth/Login';
import SignUp from '../components/auth/SignUp';
import Forum from '../components/forum/Forum';
import QuestionCreate from '../components/forum/QuestionCreate';
import QuestionSingle from '../components/forum/QuestionSingle';
import Categories from '../components/forum/Categories';

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

const ifAdmin = (to, from, next) => {
  if (User.loggedIn() && User.isAdmin()) {
    next();
    return;
  }
  next('/forum');
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
  {
    path: '/forum/ask',
    component: QuestionCreate,
    name: 'forum-ask',
    meta: {
      title: displayTitle('Ask question'),
    },
    beforeEnter: ifAuthenticated,
  },
  {
    path: '/forum/categories',
    component: Categories,
    name: 'forum-categories',
    meta: {
      title: displayTitle('Categories'),
    },
    beforeEnter: ifAdmin,
  },
  {
    path: '/forum/:slug',
    component: QuestionSingle,
    name: 'forum-single',
    meta: {
      title: false,
      originalTitle: displayTitle(''),
    },
  },
];

export default routes;
