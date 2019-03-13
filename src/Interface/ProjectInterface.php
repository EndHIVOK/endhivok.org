<?php
declare(strict_types=1);
/**
 * @file
 * Contains \EndHivOk\Project
 */

namespace EhokProject\Project;

/**
 * Project class interface.
 */
interface InterfaceName
{
    public getAuthors(): array;

    public getName(): string;

    public getVendor(): string;

    public getLabel(): string;

    public getDescription(): string;

    public getLicense(): array;

    public getTags(): array;

    public getReadme(): string;

    public getTime(): string;

    public getSupport(): array;

    public getRequire(): array;

    public getRequireDev(): array;

    public getConflict(): array;

    public getReplace(): array;

    public getProvide(): array;

    public getSuggest(): array;

    public getAutoload(): array;

    public getConfig(): array;

    public getMinimumStability(): string;

    public getRepositories(): string;

    public getScripts(): array;

    public getExtra(): array;

}


?>
