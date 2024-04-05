<template>
  <form style="margin-left: 20px;">
    <select id="selectLeague"
            name="selectLeague"
            aria-label="selectLeague"
            data-required="true"
            v-model="league"
            @change="onLeagueChange()"
    >
      <option value="" disabled selected>
        Filter by League
      </option>
      <option value="Six Nations">
        Six Nations
      </option>
      <option value="Japan League One">
        Japan League One
      </option>
      <option value="Japan League One - Division Two">
        Japan League One - Division Two
      </option>
      <option value="Super Rugby">
        Super Rugby
      </option>
      <option value="United Rugby Championship">
        United Rugby Championship
      </option>
      <option value="Premiership Rugby">
        Premiership Rugby
      </option>
      <option value="Top 14">
        Top 14
      </option>
      <option value="Champions Cup">
        Champions Cup
      </option>
      <option value="Challenge Cup">
        Challenge Cup
      </option>
      <option value="The Rugby Championship">
        The Rugby Championship
      </option>
    </select>
  </form>
</template>

<script>
export default {
  name: 'Filter',
  data() {
    return {
      league: '',
    };
  },
  props: ['page'],
  methods: {
    onLeagueChange() {
      if(this.page === 'Fixtures') {
        $.ajax({
          type: "GET",
          url: "/rugby/fixtures/" + this.league,
          success: (data) => {
            this.$emit('filtered-fixtures', data);
          }
        })
      }
      if(this.page === 'Archive') {
        $.ajax({
          type: "GET",
          url: "/rugby/past/fixtures/" + this.league,
          success: (data) => {
            this.$emit('filtered-fixtures', data);
          }
        })
      }
    }
  },
}
</script>