<template>
  <loading-component
      v-show="isLoading"
  />
  <div class="container">
    <div class="fixture-card" v-for="fixture in fixtures" :key="fixture.id" :class="'fixture-' + fixture.id">
      <div v-if="fixture.highlights" @click="getHighlightsVideo(fixture.highlights, fixture.homeTeam, fixture.awayTeam, fixture.league)">
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
import LoadingComponent from '../components/loading';

export default {
  name: 'Fixture',
  props: ['fixtures', 'page'],
  components: {
    LoadingComponent
  },
  data() {
    return {
      isLoading: true
    };
  },
  methods: {
    getHighlightsVideo(highlights, homeTeam, awayTeam, league) {
      const header = document.querySelector("header");

      header.classList.toggle ("hide-header");

      if(highlights === 'NoYouTubeVideo') {
        $.sweetModal({
          content: '<video width="660" height="415" controls><source src="/assets/video/'+homeTeam+' v '+awayTeam+'.mp4" type="video/mp4"></video>',
        });
      } else if(league === 'Top 14') {
        $.sweetModal({
          content: '<a href="'+highlights+'" target="_blank"><svg class="play-button" xmlns="http://www.w3.org/2000/svg" width="120" height="120" viewBox="0 0 24 24">\n' +
              '    <path d="M12 2C6.486 2 2 6.486 2 12s4.486 10 10 10 10-4.486 10-10S17.514 2 12 2zm0 18c-4.411 0-8-3.589-8-8s3.589-8 8-8 8 3.589 8 8-3.589 8-8 8z"></path>\n' +
              '    <path d="m9 17 8-5-8-5z"></path>\n' +
              '</svg></a>',
        });
      } else {
        $.sweetModal({
          content: '<iframe width="660" height="415" src="'+highlights+'?&autoplay=1" title="YouTube Video Player" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen class="video-player"></iframe>',
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
  mounted() {
    // Simulate loading process
    setTimeout(() => {
      this.isLoading = false; // Set to false when loading is complete
    }, 1000); // Adjust the timeout according to your actual loading time
  }
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

.fixture-881 img {
  max-width: 117px;
  max-height: 117px;
}

.fixture-882 img {
  max-width: 106px;
  max-height: 106px;
}

.fixture-872 img {
  max-width: 123px;
  max-height: 123px;
}

.fixture-849 img {
  max-width: 119px;
  max-height: 119px;
}

.fixture-898 img {
  max-width: 117px;
  max-height: 117px;
}

.fixture-918 img {
  max-width: 107px;
  max-height: 107px;
}

.fixture-929 img {
  max-width: 107px;
  max-height: 107px;
}

.fixture-935 img {
  max-width: 119px;
  max-height: 119px;
}

.fixture-942 img {
  max-width: 123px;
  max-height: 123px;
}

.play-button {
  fill: rgba(0, 0, 0, 1);
  transition: fill 0.3s ease;
}

.play-button:hover {
  fill: rgba(243, 6, 6, 0.5);
}
</style>