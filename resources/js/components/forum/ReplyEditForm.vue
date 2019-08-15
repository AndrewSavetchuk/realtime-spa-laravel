<template>
  <v-form
    class="w-100"
    @submit.prevent="update"
  >
    <vue-simplemde
      v-model="form.body"
      class="mb-4"
    />

    <v-btn
      color="green"
      type="submit"
      class="mr-2"
      :disabled="formIsValid"
    >
      Save
    </v-btn>
    <v-btn
      type="button"
      @click.prevent="$emit('cancel')"
    >
      Cancel
    </v-btn>
  </v-form>
</template>

<script>
export default {
  props: [
    'reply',
    'questionSlug',
  ],

  data() {
    return {
      form: {
        body: this.reply.body,
      },
      error: {},
    };
  },

  computed: {
    formIsValid() {
      return !this.form.body;
    },
  },

  methods: {
    update() {
      axios.patch(`/api/questions/${this.questionSlug}/replies/${this.reply.id}`, this.form).then((res) => {
        this.$emit('saved', res.data);
      });
    },
  },
};
</script>
