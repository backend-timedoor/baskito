<?php

namespace App\Supports\UIAvatar;

class UIAvatar
{
    /**
     * API url for generate avatar
     */
    protected string $url = 'https://ui-avatars.com/api/';

    /**
     * @param  array<string, mixed>  $options
     */
    final public function __construct(
        protected array $options = [],
    ) {

    }

    /**
     * Create new instance
     *
     * @param  array<string, mixed>  $options
     * @return static
     */
    public static function make(array $options = [])
    {
        return new static($options);
    }

    /**
     * Generate avatar from name
     */
    public function generate(string $name): string
    {
        $options = array_merge(
            $this->options,
            compact('name'),
        );

        return $this->url.'?'.http_build_query($options);
    }

    /**
     * Avatar image size in pixels. Between: 16 and 512.
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function size(int $size)
    {
        if ($size < 16 || $size > 512) {
            throw new \InvalidArgumentException('Avatar size must be between 16 and 512.');
        }

        $this->options['size'] = $size;

        return $this;
    }

    /**
     * Font size in percentage of size. Between 0.1 and 1.
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     */
    public function fontSize(float $size)
    {
        if ($size < 0.1 || $size > 1) {
            throw new \InvalidArgumentException('Font size must be between 0.1 and 1.');
        }

        $this->options['font-size'] = $size;

        return $this;
    }

    /**
     * Length of the generated initials. Between 1 and 3.
     *
     * @return static
     *
     * @throws \InvalidArgumentException
     **/
    public function length(int $length)
    {
        if ($length < 1 || $length > 3) {
            throw new \InvalidArgumentException('Initials length must be between 1 and 3.');
        }

        $this->options['length'] = $length;

        return $this;
    }

    /**
     * Specifying if the returned image should be a circle
     *
     * @return static
     */
    public function rounded()
    {
        $this->options['rounded'] = true;

        return $this;
    }

    /**
     * Specifying if the returned letters should use a bold font
     *
     * @return static
     */
    public function bold()
    {
        $this->options['bold'] = true;

        return $this;
    }

    /**
     * Decide if the API should lowercase the name/initials
     *
     * @return static
     */
    public function lowercase()
    {
        $this->options['uppercase'] = false;

        return $this;
    }

    /**
     * Hex color for the image background, without the hash (`#`). Default: `f0e9e9`.
     * Use `random` to randomize the color.
     *
     * @return static
     */
    public function background(string $color)
    {
        $this->options['background'] = $color;

        return $this;
    }

    /**
     * Hex color for the font, without the hash (`#`). Default: `8b5d5d`.
     *
     * @return static
     */
    public function color(string $color)
    {
        $this->options['color'] = $color;

        return $this;
    }
}
