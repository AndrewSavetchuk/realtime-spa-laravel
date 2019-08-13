<template>
  <v-layout row wrap>
    <v-flex xs12 class="pt-0">
      <question-edit-form
        v-if="editing"
        :question="question"
        @saved="editing = false;fetchQuestion()"
        @cancel="editing = false"
      />
      <v-card v-if="question && !editing">
        <v-card-title>
          <div>
            <h3 class="headline mb-0">
              {{ question.title }}
            </h3>
          </div>
          <v-spacer></v-spacer>
          <v-btn color="teal">5 Replies</v-btn>
        </v-card-title>
        <v-card-text>
          <div class="grey--text">
            {{ question.user }} asked {{ question.created_at }}
          </div>
          <div
            v-html="body"
          />
        </v-card-text>
        <v-card-actions v-if="own">
          <v-btn
            text
            small
            @click.prevent="editing = true"
          >
            Edit
          </v-btn>
          <v-btn
            text
            small
            color="red"
            @click.prevent="destroy"
          >
            Delete
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
import QuestionEditForm from './QuestionEditForm';

export default {
  components: {
    QuestionEditForm
  },

  data() {
    return {
      question: null,
      own: null,
      editing: false,
    };
  },

  computed: {
    body: function() {
      return md.parse(this.question.body);
    },
  },

  created() {
    this.fetchQuestion();
  },

  methods: {
    fetchQuestion() {
      axios.get(`/api/questions/${this.$route.params.slug}`).then((res) => {
        this.question = res.data.data;
        this.own = User.own(res.data.data.user_id);
        this.setPageTitle(res.data.data.title);
      });
    },

    setPageTitle(title) {
      document.querySelector('title').textContent = title + this.$route.meta.originalTitle;
    },

    destroy() {
      axios.delete(`/api/questions/${this.question.slug}`).then(() => {
        this.$router.push('/forum');
      })
    },
  },
};
</script>