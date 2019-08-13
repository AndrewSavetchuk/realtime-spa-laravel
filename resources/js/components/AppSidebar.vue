<template>
  <v-card>
    <v-toolbar dense>
      <v-toolbar-title>
        Categories
      </v-toolbar-title>
    </v-toolbar>

    <v-list>
      <v-list-item
        v-for="category in categories"
        :key="category.id"
      >
        <v-list-item-content>
          <v-list-item-title>
            {{ category.title }}
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-card>
</template>

<script>
export default {
  data() {
    return {
      categories: null,
    };
  },

  created() {
    this.fetchCategories();
  },

  methods: {
    fetchCategories() {
      axios.get('/api/categories').then((res) => this.categories = res.data.data);
    },
  },
};
</script>
