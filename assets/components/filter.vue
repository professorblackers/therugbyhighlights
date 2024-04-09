<template>
  <select
      class="select-new"
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
    <option value="Japan League One - Division Three">
      Japan League One - Division Three
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

<style>
.select-new {
  display: block;
  font-size: 16px;
  font-family: 'Russo One', sans-serif;
  font-weight: 400;
  color: #444;
  line-height: 1.3;
  padding: .4em 1.4em .3em .8em;
  width: 400px;
  max-width: 100%;
  box-sizing: border-box;
  margin: 20px auto;
  border: 1px solid #aaa;
  box-shadow: 0 1px 0 1px rgba(0,0,0,.03);
  border-radius: .3em;
  -moz-appearance: none;
  -webkit-appearance: none;
  appearance: none;
  background-color: #fff;
  background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23007CB2%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E'),
  linear-gradient(to bottom, #ffffff 0%,#f7f7f7 100%);
  background-repeat: no-repeat, repeat;
  background-position: right .7em top 50%, 0 0;
  background-size: .65em auto, 100%;
}
.select-new::-ms-expand {
  display: none;
}
.select-new:hover {
  border-color: #888;
}
.select-new:focus {
  border-color: #aaa;
  box-shadow: 0 0 1px 3px rgba(59, 153, 252, .7);
  color: #222;
  outline: none;
}
.select-new option {
  font-weight:normal;
}
</style>