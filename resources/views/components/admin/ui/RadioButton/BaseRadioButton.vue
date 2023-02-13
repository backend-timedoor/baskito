<template>
  <div class="custom-control custom-radio" :class="{'custom-control-inline': inline}">
    <input type="radio" class="custom-control-input" 
      :id="inputId"
      :name="name" 
      :value="value"
      :disabled="disabled" 
      :checked="isChecked"
      @input="updateValue">
    <label class="custom-control-label" :for="inputId">{{ label }}</label>
  </div>
</template>

<script setup lang="ts">
  import { ref, watch } from 'vue';

  type RadioButtonModelValueType = string | number | null;

  const props = withDefaults(
    defineProps<{
      inputId: string;
      name?: string;
      value?: string;
      modelValue?: RadioButtonModelValueType;
      label?: string;
      inline?: boolean;
      disabled?: boolean;
      checked?: boolean;
    }>(),
    {
      value: () => "on",
      inline: () => false,
      disabled: () => false,
      checked: () => false
    }
  );

  const emit = defineEmits<{
    (e: "update:modelValue", value: RadioButtonModelValueType): void;
  }>();

  const isChecked = ref(props.checked);

  watch(
    () => props.modelValue,
    (modelValue) => {
      if (modelValue) {
        updateChecked(modelValue);
      }
    }
  );

  const updateChecked = (modelValue: RadioButtonModelValueType) => {
      if (modelValue == props.value) {
          isChecked.value = true;
      } else {
          isChecked.value = false;
      }
  };
  
  if (props.modelValue) {
    updateChecked(props.modelValue);
  }

  const updateValue = (e: Event) => {
      emit('update:modelValue', props.value);
  };
</script>