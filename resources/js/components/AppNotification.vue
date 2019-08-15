<template>
  <div
    v-if="unread && unread.length || read && read.length"
    class="text-center"
  >
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn
          v-on="on"
          :color="unreadCounter > 0 ? 'teal' : ''"
        >
          <v-icon>
            add_alert
          </v-icon>
          <span class="pl-1">{{ unreadCounter }}</span>
        </v-btn>
      </template>
      <v-list>
        <v-list-item
          v-for="item in unread"
          :key="`unread-${item.id}`"
        >
          <router-link
            :to="`/forum/${item.data ? item.data.path : item.path}`"
          >
            <v-list-item-title
              @click="markAsRead(item)"
            >
              <strong>
                {{ item.data ? item.data.question : item.question }}
              </strong>
            </v-list-item-title>
          </router-link>
        </v-list-item>
        <v-divider v-if="unread && unread.length && read && read.length" />
        <v-list-item
          v-for="item in read"
          :key="`read-${item.id}`"
        >
          <v-list-item-title>
            {{ item.data ? item.data.question : item.question }}
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>
  </div>
</template>

<script>
export default {
  data() {
    return {
      read: null,
      unread: null,
      unreadCounter: 0,
    };
  },

  created() {
    this.getNotifications();
    this.listen();
  },

  methods: {
    getNotifications() {
      if (User.loggedIn()) {
        axios.post('/api/notifications').then((res) => {
          this.read = res.data.read;
          this.unread = res.data.unread;
          this.unreadCounter = res.data.unread.length;
        });
      }
    },

    markAsRead(item) {
      axios.post('/api/notifications/mark-as-read', {
        id: item.id,
      }).then(() => {
        this.unread.splice(item, 1);
        this.read.push(item);
        this.unreadCounter--;
      });
    },

    listen() {
      Echo.private('App.User.' + User.id()).notification((notification) => {
        this.unread.unshift(notification);
        this.unreadCounter++;
      });
    },
  },
};
</script>
