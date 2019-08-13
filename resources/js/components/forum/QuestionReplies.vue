<template>
  <div v-if="replies">
    <v-card
      v-for="(reply, index) in repliesList"
      :key="reply.id"
      class="mt-4"
    >
      <v-card-text>
        <div v-if="!editing || editing !== reply.id">
          <h3 class="mb-0">
            {{ reply.user }} answered {{ reply.created_at }}
          </h3>
          <v-divider class="mt-2 mb-2" />
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

export default {
  components: {
    ReplyEditForm,
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
