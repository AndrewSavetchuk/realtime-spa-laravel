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
          label="Title"
          v-model="form.title"
          type="text"
          required
        />

        <v-select
          v-model="form.categoryId"
          :items="categories"
          item-text="title"
          item-value="id"
          label="Category"
          autocomplete
        />

        <vue-simplemde
          v-model="form.body"
          class="mb-4"
        />

        <v-btn
          color="green"
          type="submit"
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
      error: {},
    };
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
      }).catch((error) => {
        this.error = error.response.data.error;
      });
    },
  },
};
</script>
