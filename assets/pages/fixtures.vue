<template>
  <section>
    <fixture-component
        :fixtures="fixtures"
        :page="page"
    />
  </section>
</template>

<script>
import FixtureComponent from '../components/fixture';

export default {
  name: 'Fixtures',
  data() {
    return {
      fixtures: [],
      page: 'Fixtures'
    };
  },
  components: {
    FixtureComponent
  },
  computed: {

  },
  methods: {
    getFixtures: function() {
      $.ajax({
        type: "GET",
        url: "/rugby/getUpcomingFixtures/",
        success: (data) => {
          this.fixtures = data;
        }
      })
    }
  },
  created() {
    this.getFixtures()
  }
}
</script>