<template>
  <v-layout
    align-center
    justify-center
  >
    <v-flex xs8>
      <v-form
        class="w-100"
        @submit.prevent="update"
      >
        <v-text-field
          v-model="form.title"
          label="Title"
          type="text"
          required
        />
        <div
          v-if="errors.title"
          class="red--text"
        >
          {{ errors.title[0] }}
        </div>

        <vue-simplemde
          v-model="form.body"
          class="mb-4"
        />
        <div
          v-if="errors.body"
          class="red--text"
        >
          {{ errors.title[0] }}
        </div>

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
      errors: {},
    };
  },

  computed: {
    formIsValid() {
      return !(this.form.title && this.form.body);
    },
  },

  methods: {
    update() {
      axios.patch(`/api/questions/${this.question.slug}`, this.form).then((res) => {
        this.$emit('saved', res.data);
      }).catch((error) => this.errors = error.data.errors);
    },
  },
};
</script>
