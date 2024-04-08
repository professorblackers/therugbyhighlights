<template>
  <div class="container">
    <div class="fixture-card" v-for="fixture in fixtures" :key="fixture.id" :class="'fixture-' + fixture.id">
      <div v-if="fixture.highlights" @click="getHighlightsVideo(fixture.highlights, fixture.homeTeam, fixture.awayTeam)">
        <div class="league-name">
          <p>{{ fixture.league }}</p>
        </div>
        <div class="team-logos">
          <div class="team-logo">
            <img :src="'/assets/img/' + fixture.homeTeam + '.png'" :alt="fixture.homeTeam">
          </div>
          <div class="team-logo">
            <img :src="'/assets/img/' + fixture.awayTeam + '.png'" :alt="fixture.awayTeam">
          </div>
        </div>
      </div>
      <div v-else>
        <div class="league-name">
          <p>{{ fixture.league }}</p>
        </div>
        <div class="team-logos">
          <div class="team-logo">
            <img v-if="page === 'Fixtures' || page === 'Archive'" :src="'/assets/img/' + fixture.homeTeam + '.png'" :alt="fixture.homeTeam">
            <img v-else :src="'/assets/img/' + fixture.homeTeam + '.png'" :alt="fixture.homeTeam" class="inactive-fixture">
          </div>
          <div class="team-logo">
            <img v-if="page === 'Fixtures' || page === 'Archive'" :src="'/assets/img/' + fixture.awayTeam + '.png'" :alt="fixture.awayTeam">
            <img v-else :src="'/assets/img/' + fixture.awayTeam + '.png'" :alt="fixture.awayTeam" class="inactive-fixture">
          </div>
        </div>
      </div>
      <div v-if="page === 'Fixtures' || page === 'Archive'" class="kickoff-time">
        <p>{{ formatKickoffTime(fixture.kickOff.date) }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Fixture',
  props: ['fixtures', 'page'],
  methods: {
    getHighlightsVideo(highlights, homeTeam, awayTeam) {
      const header = document.querySelector("header");

      header.classList.toggle ("hide-header");

      if(highlights === 'NoYouTubeVideo') {
        $.sweetModal({
          content: '<video width="660" height="415" controls><source src="/assets/video/'+homeTeam+' v '+awayTeam+'.mp4" type="video/mp4"></video>',

          theme: $.sweetModal.THEME_DARK
        });
      } else {
        $.sweetModal({
          content: '<iframe width="660" height="415" src="'+highlights+'?&autoplay=1" title="YouTube Video Player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="video-player"></iframe>',
          theme: $.sweetModal.THEME_DARK
        });
      }

      const modalCloseButton = document.getElementsByClassName("sweet-modal-close-link");

      for (let i = 0; i < modalCloseButton.length; i++) {
        modalCloseButton[i].addEventListener("click", function() {
          closeModal(header);
        });
      }

      function closeModal(header) {
        header.classList.remove ("hide-header");
      }
    },
    formatKickoffTime(dateTimeString) {
      const options = { month: 'long', day: 'numeric', year: 'numeric', hour: 'numeric', minute: '2-digit' };
      const date = new Date(dateTimeString);
      return date.toLocaleString('en-US', options);
    }
  },
}
</script>

<style>
.fixture-279 img {
  max-width: 122px;
  max-height: 122px;
}

.fixture-308 img {
  max-width: 110px;
  max-height: 110px;
}

.fixture-324 img {
  max-width: 110px;
  max-height: 110px;
}

.fixture-262 img {
  max-width: 110px;
  max-height: 110px;
}
</style>