<template>
  <section>
    <filter-component
        @filtered-fixtures="filteredFixtures"
        :leagues="leagues"
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
      page: 'Archive',
      leagues: []
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
    },
    getLeagues: function () {
      $.ajax({
        type: "GET",
        url: "/rugby/getLeagues",
        success: (data) => {
          this.leagues = data;
        }
      })
    }
  },
  created() {
    this.getFixtures();
    this.getLeagues();
  }
}
</script>