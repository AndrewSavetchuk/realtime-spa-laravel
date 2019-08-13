<template>
  <v-app>
    <v-navigation-drawer
      app
      clipped
    >
      <v-list dense>
        <router-link
          v-for="item in activeItems"
          :key="item.to"
          :to="item.to"
        >
          <v-list-item>
            <v-list-item-action>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </router-link>
        <button
          v-if="isLoggedIn"
          @click.prevent="logout"
        >
          <v-list-item>
            <v-list-item-action>
              <v-icon>exit_to_app</v-icon>
            </v-list-item-action>
            <v-list-item-content>
              <v-list-item-title>Logout</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </button>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      app
      clipped-left
    >
      <v-toolbar-title>Pusher Realtime Updates Application</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container
        fluid
        grid-list-md
        fill-height
      >
        <router-view :key="$route.fullPath"></router-view>
      </v-container>
    </v-content>

    <v-footer app>
      <span>Realtime SPA with Pusher, 2019</span>
    </v-footer>
  </v-app>
</template>

<script>
export default {
  props: {
    source: String,
  },

  data() {
    return {
      isLoggedIn: User.loggedIn(),
      items: [
        {
          title: 'Forum',
          to: '/forum',
          icon: 'forum',
          show: User.loggedIn(),
        },
        {
          title: 'Ask Question',
          to: '/forum/ask',
          icon: 'add',
          show: User.loggedIn(),
        },
        {
          title: 'Login',
          to: '/login',
          icon: 'person',
          show: !User.loggedIn(),
        },
        {
          title: 'Sign Up',
          to: '/signup',
          icon: 'person_add',
          show: !User.loggedIn(),
        },
      ],
    };
  },

  computed: {
    activeItems: function() {
      return this.items.filter(function(item) {
        return item.show;
      });
    },
  },

  created() {
    this.$vuetify.theme.dark = true;
  },

  methods: {
    logout() {
      User.logout();
    },
  },
};
</script>
