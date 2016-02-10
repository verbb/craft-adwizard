<?php
namespace Craft;

class AdWizard_GroupTotalsWidget extends BaseWidget
{

	public function getTitle()
	{
		$groupId = $this->getSettings()->groupId;
		if ($groupId) {
			$group = craft()->adWizard->getGroupById($groupId);
			$title = $group->name;
		} else {
			$title = Craft::t('NEW GROUP CHART');
		}
		return $title;
	}

	public function getName()
	{
		return Craft::t('Ad Totals');
	}

	public function getIconPath()
	{
		return craft()->path->getPluginsPath().'adwizard/resources/ad-totals.svg';
	}

	public function getBodyHtml()
	{
		$groupId = $this->getSettings()->groupId;
		$chart = craft()->adWizard_widget->groupBarChart($groupId);
		$intro = '<p>Lifetime totals of ads in this group.</p>';
		return $intro.'<p>'.$chart.'</p>';
	}

	protected function defineSettings()
	{
		return array(
			'groupId' => array(AttributeType::Number),
		);
	}

	public function getSettingsHtml()
	{
		return craft()->templates->render('adwizard/_settings/widgets/ad-totals', array(
			'settings' => $this->getSettings(),
			'pluginsPath' => craft()->path->getPluginsPath(),
		));
	}

}