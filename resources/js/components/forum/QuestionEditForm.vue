<template>
  <v-layout
    align-center
    justify-center
    fill-height
  >
    <v-flex xs8>
      <v-form
        class="w-100"
        @submit.prevent="update"
      >
        <v-text-field
          label="Title"
          v-model="form.title"
          type="text"
          required
        />

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
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  props: [
    'question',
  ],

  data() {
    return {
      form: {
        title: this.question.title,
        body: this.question.body,
      },
      error: {},
    };
  },

  methods: {
    update() {
      axios.patch(`/api/questions/${this.question.slug}`, this.form).then((res) => {
        this.$emit('saved');
      });
    },
  },
};
</script>
