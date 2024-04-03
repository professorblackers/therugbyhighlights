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
  name: 'Archive',
  data() {
    return {
      fixtures: [],
      page: 'Archive'
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
        url: "/rugby/getPastFixtures/",
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