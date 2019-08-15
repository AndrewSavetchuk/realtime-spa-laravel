<template>
  <v-form
    class="mt-5 w-100"
    @submit.prevent="submit"
  >
    <vue-simplemde
      v-model="form.body"
      class="mb-4"
    />

    <v-btn
      color="green"
      type="submit"
      :disabled="formIsValid"
    >
      Reply
    </v-btn>
  </v-form>
</template>

<script>
export default {
  props: [
    'questionSlug',
  ],

  data() {
    return {
      form: {
        body: '',
      },
      errors: {},
    };
  },

  computed: {
    formIsValid() {
      return !this.form.body;
    },
  },

  methods: {
    submit() {
      axios.post(`/api/questions/${this.questionSlug}/replies`, this.form).then((res) => {
        this.form.body = '';
        this.$emit('new', res.data.reply);
      }).catch((error) => this.errors = error.data.errors);
    },
  },
};
</script>
