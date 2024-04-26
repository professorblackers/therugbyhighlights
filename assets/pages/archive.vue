<template>
  <section>
    <filter-component
        @filtered-fixtures="filteredFixtures"
        :leagues="leagues"
        :page="page"
    />

    <team-filter-component
        @filtered-fixtures="filteredFixtures"
        :teams="teams"
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
import TeamFilterComponent from '../components/teamFilter';

export default {
  name: 'Archive',
  data() {
    return {
      fixtures: [],
      page: 'Archive',
      leagues: [],
      teams: []
    };
  },
  components: {
    FixtureComponent,
    FilterComponent,
    TeamFilterComponent
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
    },
    getTeams: function () {
      $.ajax({
        type: "GET",
        url: "/rugby/getTeams",
        success: (data) => {
          this.teams = data;
        }
      })
    }
  },
  created() {
    this.getFixtures();
    this.getLeagues();
    this.getTeams();
  }
}
</script>