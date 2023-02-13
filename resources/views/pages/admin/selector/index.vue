<template layout="admin">
  <Head title="Selector" />

  <PageSection header="Selector Page" :back-link="$route('admin.dashboard')">
    <PageTitle>Selector</PageTitle>
    <PageDescription>Checkbox, Radio Button, Switch usage example.</PageDescription>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Checkbox</h4>
          </div>
          <div class="card-body">
            <div class="section-title mt-0">Single Checkbox</div>
            <BaseCheckbox input-id="customSingleCheck" label="Check this custom single checkbox" name="custom_single_check" v-model="singleCheck"/>
            
            <div class="section-title">Inline</div>
            <BaseCheckbox input-id="customInlineCheck1" label="Check 1" name="custom_inline_check[]" value="Check 1" v-model="multipleCheck" :inline="true" />
            <BaseCheckbox input-id="customInlineCheck2" label="Check 2" name="custom_inline_check[]" value="Check 2" v-model="multipleCheck" :inline="true" />
            
            <div class="section-title">Disabled</div>
            <BaseCheckbox input-id="customDisabledCheck1" label="You cannot check this custom disabled checkbox" :checked="true" :disabled="true"  />
            <BaseCheckbox input-id="customDisabledCheck2" label="You cannot check this custom disabled checkbox" :checked="false" :disabled="true"  />
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Radio Button</h4>
          </div>
          <div class="card-body">
            <div class="section-title mt-0">Inline</div>
            <BaseRadioButton input-id="customInlineRadio1" label="Radio 1" name="custom_inline_radio" value="Radio 1" v-model="radio" :inline="true" />
            <BaseRadioButton input-id="customInlineRadio2" label="Radio 2" name="custom_inline_radio" value="Radio 2" v-model="radio" :inline="true" />
            
            <div class="section-title">Disabled</div>
            <BaseRadioButton input-id="customDisabledRadio1" label="You cannot check this custom disabled radio" :checked="true" :disabled="true"  />
            <BaseRadioButton input-id="customDisabledRadio2" label="You cannot check this custom disabled radio" :checked="false" :disabled="true"  />
          </div>
        </div>
      </div>
    </div>
    
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h4>Switch</h4>
          </div>
          <div class="card-body">
            <div class="section-title mt-0">Toggle Switches</div>
            <StackSwitch>
              <BaseSwitch name="toggle_switch" description="Switch 1" value="Switch 1" v-model="switches"></BaseSwitch>
              <BaseSwitch name="toggle_switch" description="Switch 2" value="Switch 2" v-model="switches"></BaseSwitch>
            </StackSwitch>
            <div class="section-title">Toggle Switch Single</div>
            <StackSwitch>
              <BaseSwitch type="single" name="toggle_switch_single" description="I agree with terms and conditions" v-model="singleSwitch"></BaseSwitch>
            </StackSwitch>
            <div class="section-title">Disabled</div>
            <BaseSwitch name="toggle_switch" description="You cannot check this custom disabled switch" :disabled="true"></BaseSwitch>
          </div>
        </div>
      </div>
    </div>
  </PageSection>
</template>

<script setup lang="ts">
import PageDescription from "@components/admin/layout/Page/PageDescription.vue";
import PageSection from "@components/admin/layout/Page/PageSection.vue";
import PageTitle from "@components/admin/layout/Page/PageTitle.vue";
import BaseCheckbox from "@components/admin/ui/Checkbox/BaseCheckbox.vue";
import BaseRadioButton from "@components/admin/ui/RadioButton/BaseRadioButton.vue";
import BaseSwitch from "@components/admin/ui/Switch/BaseSwitch.vue";
import StackSwitch from "@components/admin/ui/Switch/StackSwitch.vue";
import { Head } from "@inertiajs/inertia-vue3";
import { ref, watch } from 'vue';

const singleCheck = ref(true);

const multipleCheck = ref(['Check 1']);

const radio = ref('Radio 1');

const switches = ref('Switch 1');

const singleSwitch = ref(false);

watch(singleCheck, (newSingleCheck) => {
  console.log(`Single check is ${newSingleCheck}`);
})

watch(multipleCheck, (newMultipleCheck) => {
  console.log("Multiple check contains:");
  console.log(newMultipleCheck);
})

watch(radio, (newRadio) => {
  console.log(`Radio button is ${newRadio}`);
})

watch(switches, (newSwitches) => {
  console.log(`Switches is ${newSwitches}`);
})

watch(singleSwitch, (newSingleSwitch) => {
  console.log(newSingleSwitch ? 'I agree with terms and conditions' : 'I do not agree with terms and conditions');
})
</script>

<style scoped></style>
