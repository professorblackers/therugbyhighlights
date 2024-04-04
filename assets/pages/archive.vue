<template>
  <section>
    <filter-component
        @filtered-fixtures="filteredFixtures"
        :page="page"
    />

    <fixture-component
        :fixtures="fixtures"
        :page="page"
    />
  </section>
</template>

<script>
import FixtureComponent from '../components/fixture';
import FilterComponent from '../components/filter';

export default {
  name: 'Archive',
  data() {
    return {
      fixtures: [],
      page: 'Archive'
    };
  },
  components: {
    FixtureComponent,
    FilterComponent
  },
  methods: {
    getFixtures: function() {
      $.ajax({
        type: "GET",
        url: "/rugby/getPastFixtures/",
        success: (data) => {
          this.fixtures = data;
        }
      })
    },
    filteredFixtures(filteredFixtures) {
      this.fixtures = filteredFixtures;
    }
  },
  created() {
    this.getFixtures()
  }
}
</script>