<template>
  <div class="container">
    <div class="fixture-card" v-for="fixture in fixtures" :key="fixture.id">
      <div v-if="fixture.highlights" @click="getHighlightsVideo(fixture.highlights)">
        <div class="league-name">
          <p>{{ fixture.league }}</p>
        </div>
        <div class="team-logos">
          <div class="team-logo">
            <img v-if="fixture.highlights" :src="'/assets/img/' + fixture.homeTeam + '.png'" alt="{{ fixture.homeTeam }}">
            <img v-else :src="'/assets/img/' + fixture.homeTeam + '.png'" alt="{{ fixture.homeTeam }}" class="inactive-fixture">
          </div>
          <div class="team-logo">
            <img v-if="fixture.highlights" :src="'/assets/img/' + fixture.awayTeam + '.png'" alt="{{ fixture.awayTeam }}">
            <img v-else :src="'/assets/img/' + fixture.awayTeam + '.png'" alt="{{ fixture.awayTeam }}" class="inactive-fixture">
          </div>
        </div>
      </div>
      <div v-else>
        <div class="league-name">
          <p>{{ fixture.league }}</p>
        </div>
        <div class="team-logos">
          <div class="team-logo">
            <img v-if="fixture.highlights" :src="'/assets/img/' + fixture.homeTeam + '.png'" alt="{{ fixture.homeTeam }}">
            <img v-else :src="'/assets/img/' + fixture.homeTeam + '.png'" alt="{{ fixture.homeTeam }}" class="inactive-fixture">
          </div>
          <div class="team-logo">
            <img v-if="fixture.highlights" :src="'/assets/img/' + fixture.awayTeam + '.png'" alt="{{ fixture.awayTeam }}">
            <img v-else :src="'/assets/img/' + fixture.awayTeam + '.png'" alt="{{ fixture.awayTeam }}" class="inactive-fixture">
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Fixture',
  props: ['fixtures'],
  methods: {
    getHighlightsVideo(highlights) {
      const header = document.querySelector("header");

      header.classList.toggle ("hide-header");

      $.sweetModal({
        content: '<iframe width="660" height="415" src="'+highlights+'?&autoplay=1" title="YouTube Video Player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="video-player"></iframe>',
        theme: $.sweetModal.THEME_DARK
      });

      const modalCloseButton = document.getElementsByClassName("sweet-modal-close-link");

      for (let i = 0; i < modalCloseButton.length; i++) {
        modalCloseButton[i].addEventListener("click", function() {
          closeModal(header);
        });
      }

      function closeModal(header) {
        header.classList.remove ("hide-header");
      }
    }
  },
}
</script>