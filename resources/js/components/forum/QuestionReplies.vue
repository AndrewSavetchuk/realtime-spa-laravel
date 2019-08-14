<template>
  <div v-if="replies">
    <v-card
      v-for="(reply, index) in repliesList"
      :key="reply.id"
      class="mt-4"
    >
      <v-card-title>
        <h6>{{ reply.user }} answered {{ reply.created_at }}</h6>
        <v-spacer />
        <like
          :reply="reply"
        />
      </v-card-title>

      <v-card-text>
        <v-divider class="mb-2" />
        <div v-if="!editing || editing !== reply.id">
          <div
            v-html="parseReplyBody(reply.body)"
          />
        </div>
        <div v-if="editing && editing === reply.id">
          <reply-edit-form
            :reply="reply"
            :question-slug="questionSlug"
            @saved="updateReply"
            @cancel="editing = false"
          />
        </div>
      </v-card-text>

      <v-card-actions
        v-if="own(reply.user_id)"
      >
        <v-btn
          text
          small
          @click="editing = reply.id"
        >
          Edit
        </v-btn>
        <v-btn
          text
          small
          color="red"
          @click="destroy(reply.id, index)"
        >
          Delete
        </v-btn>
      </v-card-actions>
    </v-card>
  </div>
</template>

<script>
import ReplyEditForm from './ReplyEditForm';
import Like from './Like';

export default {
  components: {
    ReplyEditForm,
    Like,
  },

  props: [
    'replies',
    'questionSlug',
  ],

  data() {
    return {
      repliesList: this.replies,
      editing: false,
    };
  },

  methods: {
    own(userId) {
      return User.own(userId);
    },

    destroy(replyId, index) {
      axios.delete(`/api/questions/${this.questionSlug}/replies/${replyId}`).then((res) => {
        this.repliesList.splice(index, 1);
        this.editing = false;
      });
    },

    parseReplyBody(body) {
      return md.parse(body);
    },

    updateReply(reply) {
      const replyIndex =_.findIndex(this.replies, { id: reply.id });
      this.replies[replyIndex].body = reply.body;
      this.editing = false;
    },
  },
};
</script>
