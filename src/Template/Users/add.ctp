<?php
$urlToLinkedListFilter = $this->Url->build([
    "controller" => "Countries",
    "action" => "getCountries",
    "_ext" => "json"
]);
echo $this->Html->scriptBlock('var urlToLinkedListFilter = "' . $urlToLinkedListFilter . '";', ['block' => true]);
echo $this->Html->script('Users/add', ['block' => 'scriptBottom']);
?>


<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<nav class="large-2 medium-3 columns" id="actions-sidebar">
    <ul class="side-nav">
        
    </ul>
</nav>
<div class="users form large-10 medium-9 columns content" ng-app="linkedlists" ng-controller="countriesController">
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?php
            echo $this->Form->control('email');
            echo $this->Form->control('password'); ?>

            <div>
            Countries:
            <select name="Country_id"
                    id="country-id"
                    ng-model="country"
                    ng-options="country.name for country in countries track by country.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>
        <div>
            Provinces:
            <select name="province_id"
                    id="province-id"
                    ng-disabled="!country"
                    ng-model="province"
                    ng-options="province.name for province in country.provinces track by province.id"
                    >
                <option value=''>Select</option>
            </select>
        </div>

        <?php
            echo $this->Form->hidden('role', ['default' => '1']);
            echo $this->Form->hidden('uuid', ['default' => $uuid]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
