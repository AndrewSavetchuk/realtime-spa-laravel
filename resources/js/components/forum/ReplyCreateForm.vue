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
    };
  },

  methods: {
    submit() {
      axios.post(`/api/questions/${this.questionSlug}/replies`, this.form).then((res) => {
        this.form.body = '';
        this.$emit('new', res.data.reply);
      });
    },
  },
};
</script>
