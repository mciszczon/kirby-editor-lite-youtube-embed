<template>
  <figure>
    <template v-if="attrs.videoId">
      <div
          ref="element"
          tabindex="0"
          @keydown.backspace="$emit('remove')"
          @keydown.delete="$emit('remove')"
          @keydown.enter.prevent="$emit('append')"
          @keydown.up="$emit('prev')"
          @keydown.down="$emit('next')"
      >
        <lite-youtube :videoid="attrs.videoId"></lite-youtube>
      </div>
      <figcaption class="k-editor-lite-youtube-embed-caption">
        <k-editable
            :content="attrs.caption"
            :breaks="true"
            :placeholder="$t('editor.blocks.lite-youtube-embed.caption.placeholder') + '…'"
            @prev="focus"
            @shiftTab="focus"
            @tab="$emit('next', $event)"
            @next="$emit('next', $event)"
            @split="$emit('append')"
            @enter="$emit('append')"
            @input="caption"
        />
      </figcaption>
      <k-dialog ref="settings" @submit="$refs.settings.close()" size="medium">
        <k-form :fields="fields" v-model="attrs" @submit="$refs.settings.close()"/>
      </k-dialog>
    </template>
    <template v-else>
      <div data-theme="field" data-type="text" class="k-input">
        <span class="k-input-element">
          <input
              class="k-text-input"
              ref="element"
              type="text"
              :placeholder="$t('editor.blocks.lite-youtube-embed.placeholder') + '…'"
              v-model="attrs.videoId"
              @keydown.up="$emit('prev')"
              @keydown.down="$emit('next')"
              @keydown.enter.prevent="$emit('append')"
          >
        </span>
        <span class="k-input-icon">
          <span aria-hidden="true" class="k-icon k-icon-video">
            <svg viewBox="0 0 16 16">
              <use xlink:href="#icon-video"></use>
            </svg>
          </span>
        </span>
      </div>
    </template>
  </figure>
</template>

<script>
import LiteYouTubeEmbed from 'lite-youtube-embed'
import styles from 'lite-youtube-embed/src/lite-yt-embed.css'

export default {
  label: 'Lite YouTube Embed',
  icon: 'video',
  props: {
    attrs: {
      type: Object,
      default () {
        return {
          videoId: null
        }
      }
    },
  },
  computed: {
    fields () {
      return {
        videoId: {
          label: this.$t('editor.blocks.lite-youtube-embed.videoId.label'),
          type: 'text',
          icon: 'video',
          placeholder: this.$t('editor.blocks.lite-youtube-embed.placeholder')
        },
      }
    }
  },
  methods: {
    focus () {
      this.$refs.element.focus()
    },
    caption (html) {
      this.$emit('input', {
        attrs: {
          ...this.attrs,
          caption: html
        }
      })
    },
    menu () {
      if (this.attrs.videoId) {
        return [
          {
            icon: 'open',
            label: this.$t('editor.blocks.lite-youtube-embed.open'),
            click: this.open
          },
          {
            icon: 'video',
            label: this.$t('editor.blocks.lite-youtube-embed.settings'),
            click: this.$refs.settings.open
          },
        ]
      } else {
        return []
      }

    },
    open () {
      window.open('https://youtube.com/watch?v=' + this.attrs.videoId, '_blank')
    },
    replace () {
      this.$emit('input', {
        attrs: { videoId: null }
      })

      this.$nextTick(() => {
        this.focus()
      })
    }
  }
}
</script>

<style lang="scss">
@import "../variables.scss";

.k-editor-lite-youtube-embed-block {
  margin: 16px 0;
}

.k-editor-lite-youtube-embed-input {
  width: 100%;
}

.k-editor-lite-youtube-embed-caption {
  margin-top: 16px;
  font-family: $font-family-sans;
  font-size: $font-size-small;
  text-align: center;
}
</style>