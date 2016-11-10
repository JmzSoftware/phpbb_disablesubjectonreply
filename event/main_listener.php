<?php
/**
 *
 * Disable subject editing. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2016, Jmz Software, https://jmzsoftware.com
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace jmz\disablesubject\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Disable subject editing Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	static public function getSubscribedEvents()
	{
		return array(
			'core.modify_posting_parameters'	=> 'disable_subject',
		);
	}

	/* @var \phpbb\template\template */
	protected $template;

	/**
	 * Constructor
	 *
	 * @param \phpbb\template\template	$template	Template object
	 */
	public function __construct(\phpbb\template\template $template)
	{
		$this->template = $template;
	}

	public function disable_subject($event)
	{
		if ($event['mode'] != 'post' && $event['mode'] != 'edit')
		{
			$this->template->assign_vars(array(
				'S_IS_REPLY' => true,
			));
		}
	}
}
