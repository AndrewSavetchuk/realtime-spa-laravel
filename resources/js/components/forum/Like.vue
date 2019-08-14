<template>
  <div>
    <v-btn
      text
      :color="liked ? 'green' : ''"
      @click="like"
    >
      <v-icon>favorite</v-icon>
      <span class="pl-1">
        {{ count }}
      </span>
    </v-btn>
  </div>
</template>

<script>
export default {
  props: [
    'reply',
  ],

  data() {
    return {
      liked: this.reply.liked,
      count: this.reply.likes_count,
    };
  },

  methods: {
    like() {
      if(User.loggedIn()) {
        this.liked ? this.decr() : this.incr();
        this.liked = !this.liked;
      }
    },

    decr() {
      axios.post(`/api/dislike/${this.reply.id}`).then(() => {
        this.count--;
      });
    },

    incr() {
      axios.post(`/api/like/${this.reply.id}`).then(() => {
        this.count++;
      });
    },
  },
};
</script>
