<template>
  <v-layout
    align-center
    justify-center
  >
    <v-flex xs8>
      <v-form
        class="w-100"
        @submit.prevent="ask"
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

        <v-select
          v-model="form.categoryId"
          :items="categories"
          item-text="title"
          item-value="id"
          label="Category"
          autocomplete
        />
        <div
          v-if="errors.categoryId"
          class="red--text"
        >
          {{ errors.categoryId[0] }}
        </div>

        <vue-simplemde
          v-model="form.body"
          class="mb-4"
        />
        <div
          v-if="errors.body"
          class="red--text"
        >
          {{ errors.body[0] }}
        </div>

        <v-btn
          color="green"
          type="submit"
          :disabled="formIsValid"
        >
          Ask Question
        </v-btn>
      </v-form>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  data() {
    return {
      categories: null,
      form: {
        title: '',
        categoryId: '',
        body: '',
      },
      errors: {},
    };
  },

  computed: {
    formIsValid() {
      return !(this.form.title && this.form.body && this.form.categoryId);
    },
  },

  created() {
    this.fetchCategories();
  },

  methods: {
    fetchCategories() {
      axios.get('/api/categories').then((res) => this.categories = res.data.data);
    },

    ask() {
      axios.post('/api/questions', this.form).then((res) => {
        this.$router.push(`/forum/${res.data.slug}`);
      }).catch((error) => this.errors = error.data.errors);
    },
  },
};
</script>
