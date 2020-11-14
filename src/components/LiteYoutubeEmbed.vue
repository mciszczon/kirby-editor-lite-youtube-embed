<template>
  <link rel="stylesheet" href="node_modules/lite-youtube-embed/src/lite-yt-embed.css" type="text/css"/>
  <lite-youtube videoid="{{ videoId }}"></lite-youtube>
</template>

<script>
import LiteYouTubeEmbed from 'lite-youtube-embed'

export default {
  label: 'Lite YouTube Embed',
  icon: 'video',
  props: {
    videoId: String,
    attrs: [Array, Object]
  },
  data () {
    return {
      videoId: this.videoId,
    }
  },
  methods: {
    // the block must be focusable somehow
    // use tabindex=0 on a wrapping element
    // if there's no real input. The focus event
    // recieves a cursor position that should be
    // focused if possible. This is just a suggestion
    // from the editor to enhance keyboard navigation
    focus(cursor) {
      // the content editable component can be focused
      // with a specific cursor position, so we can
      // pass it further down
      this.$refs.input.focus(cursor);
    },
    // when delete is being pressed in the editable
    // and the cursor is at the first position a "back"
    // event is fired, which can be used to delete the entire block,
    // when it is empty or to merge it with the previous block.
    // we can pass the back event to the editor to take care of this.
    onBack(event) {
      this.$emit("back", event);
    },
    // send the state of the todo as attribute
    onCheck() {
      this.$emit("input", {
        attrs: {
          done: !this.attrs.done
        }
      });
    },
    // enter is only fired in the editable component
    // when the cursor is at the end of the text. Otherwise
    // a split event will be fired. The enter event can
    // thus be used to either append a new block or in this case
    // convert a todo to a simple paragraph when the todo is empty
    // this is the same behavior as in list elements
    onEnter() {
      if (this.content.length === 0) {
        this.$emit("convert", "paragraph");
      } else {
        this.$emit("append", {
          type: "todo"
        });
      }
    },
    // whenever the text changes in the editable component
    // we send an input event to the editor and pass the html
    // of the editable component as content
    onInput(html) {
      this.$emit("input", {
        content: html
      });
    },
    // the editable component sends a next event when
    // the last line is reached and the down arrow is pressed.
    // we can pass this to the editor to focus on
    // the next block
    onNext(cursor) {
      this.$emit("next", cursor);
    },
    // the editable component sends a prev event when
    // the first line is reached and the up arrow is pressed.
    // we can pass this to the editor to focus on
    // the previous block
    onPrev(cursor) {
      this.$emit("prev", cursor);
    },
    // when enter is pressed in the middle of the text
    // a split event is fired that recieves an object with
    // content "before" and "after" the cursor. This can be
    // forwarded to the editor, which will then create two
    // blocks out of the one
    onSplit(data) {
      this.$emit("split", data);
    }
  }
}
</script>

<style>
@import './../../node_modules/lite-youtube-embed/src/lite-yt-embed.css';

.k-editor-lite-youtube-embed-block {

}
</style>