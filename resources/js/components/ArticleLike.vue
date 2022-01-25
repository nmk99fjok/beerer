<template>

    <button
      type="button"
      class="
        btn btn-sm
        shadow-none
        p-2
        waves-effect
        btn-outline-indigo
        rounded-circle
      "
    >
      <i class="fas fa-heart fa-lg"
         :class="{'red-text': this.isLikedBy, 'animated heartBeat fast': this.likeAnim}"
         @click="clickLike"
         >
      </i>
    </button>

</template>

<script>
    export default {
        props: {
            initialIsLikedBy: {
                type: Boolean,
                default: false,
            },
            authorized: {
                type: Boolean,
                default: false,
            },
            endpoint: {
                type: String,
            },
        },
        data() {
            return {
                isLikedBy: this.initialIsLikedBy,
                likeAnim: false,
            }
        },
        methods: {
            clickLike() {
                if (!this.authorized) {
                    alert('お気に入り登録はログイン中のみ可能です！')
                    return
                }

                this.isLikedBy ?this.unlike()
                               :this.like()
            },
            async like() {
                const response = await axios.put(this.endpoint)

                this.isLikedBy = true
                this.likeAnim = true
            },
            async unlike() {
                const response = await axios.delete(this.endpoint)

                this.isLikedBy = false
                this.likeAnim = false
            },
        },
    }
</script>
