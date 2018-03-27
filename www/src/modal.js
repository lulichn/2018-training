const Modal = {
  name: 'modal',
  template: `
    <transition name="modal-fade">
      <div class="modal-backdrop">
        <div class="modal"
            role="dialog"
            aria-labelledby="modalTitle"
            aria-describedby="modalDescription">
          <section
              class="modal-body"
              id="modalDescription">
            <slot name="body">
              {{ modalValue.message }}
            </slot>
          </section>
          <footer class="modal-footer">
            <slot name="footer">
              <a class="button" @click="close">
                {{ modalValue.button.message }}
              </button>
            </slot>
          </footer>
        </div>
      </div>
    </transition>
  `,
  props: [
    'modalValue'
  ],
  methods: {
    close() {
      this.$emit('close');
    },
  }
}

