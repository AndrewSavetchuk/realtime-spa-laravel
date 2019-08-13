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

  methods: {
    update() {
      axios.patch(`/api/questions/${this.questionSlug}/replies/${this.reply.id}`, this.form).then((res) => {
        this.$emit('saved', res.data);
      });
    },
  },
};
</script>
