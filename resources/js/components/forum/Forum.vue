<template>
  <v-layout
    row
    wrap
  >
    <v-flex xs8 class="pt-0">
      <v-card
        v-for="question in questions"
        :key="question.slug"
        class="mb-3"
      >
        <v-card-title primary-title>
          <div>
            <h3 class="headline mb-0">
              <router-link
                :to="{ name: 'forum-single', params: { slug: question.slug }}"
              >
                {{ question.title }}
              </router-link>
            </h3>
          </div>
        </v-card-title>
        <v-card-text>
          <div class="grey--text">
            {{ question.user }} asked {{ question.created_at }}
          </div>
          {{ question.body }}
        </v-card-text>
      </v-card>
    </v-flex>
    <v-flex xs4 class="pt-0">
      <app-sidebar />
    </v-flex>
  </v-layout>
</template>

<script>
import AppSidebar from '../AppSidebar';

export default {
  components: {
    AppSidebar,
  },

  data() {
    return {
      questions: [],
    };
  },

  created() {
    this.fetchQuestions();
  },

  methods: {
    fetchQuestions() {
      axios.get('/api/questions/').
        then((res) => this.questions = res.data.data).
        catch((error) => console.log(error.response.data));
    },
  },
};
</script>
