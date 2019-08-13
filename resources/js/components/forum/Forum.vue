<template>
  <v-layout row wrap>
    <v-flex xs8 class="pt-0">
      <question
        v-for="question in questions"
        :key="question.slug"
        :question="question"
      />
    </v-flex>
    Sidebar
  </v-layout>
</template>

<script>
import Question from './Question';

export default {
  components: {
    Question,
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
