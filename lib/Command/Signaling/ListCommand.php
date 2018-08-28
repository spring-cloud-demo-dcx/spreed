<?php
declare(strict_types=1);
/**
 * @copyright Copyright (c) 2018 Denis Mosolov <denismosolov@gmail.com>
 *
 * @author Denis Mosolov <denismosolov@gmail.com>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OCA\Spreed\Command\Signaling;

use OCP\IConfig;
use OC\Core\Command\Base;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ListCommand extends Base {

	/** @var IConfig */
	private $config;

	/**
	 */
	public function __construct(IConfig $config) {
		parent::__construct();
		$this->config = $config;
	}

	protected function configure() {
		parent::configure();

		$this
			->setName('talk:signaling:list')
			->setDescription('List external signaling servers.');
	}

	protected function execute(InputInterface $input, OutputInterface $output) {
		$config = $this->config->getAppValue('spreed', 'signaling_servers');
		$signaling = json_decode($config, true);
		if (!is_array($signaling)) {
			$signaling = [];
		}

		$this->writeMixedInOutputFormat($input, $output, $signaling);
	}
}
