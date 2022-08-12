<?php


namespace Classes;

class AssignValues
{
    protected array $post;
    protected array $user1;
    protected array $user2;

    public function __construct(array $post)
    {
        $this->post = $post;
    }

    public function validation()
    {
        session_unset();
        foreach ($this->post as $key => $item) {
            if(empty($item)) continue;
            if(!is_numeric($item)) {
                $_SESSION[$key] = "Only Integer";
            }
        }
    }

    public function fillArray(): self
    {
        if($this->post) {
            $this->user1 = [
                'Magician' => (int)$this->post['Magician_1'],
                'Warlock' => (int)$this->post['Warlock_1'],
                'Paladin' => (int)$this->post['Paladin_1']
            ];
            $this->user2 = [
                'Magician' => (int)$this->post['Magician_2'],
                'Warlock' => (int)$this->post['Warlock_2'],
                'Paladin' => (int)$this->post['Paladin_2']
            ];
        }
        $this->deleteEmptyValues();

        return $this;
    }

    protected function deleteEmptyValues(): void
    {
        foreach ($this->user1 as $key => $value) {
            if($value == 0) {
                unset($this->user1[$key]);
            }
        }
        foreach ($this->user2 as $key => $value) {
            if($value == 0) {
                unset($this->user2[$key]);
            }
        }
        $this->checkCommands();

    }

    protected function checkCommands()
    {
        if(empty($this->user1) || empty($this->user2)) {
            $_SESSION['twoCommands'] = "Two teams must participate in the battle";
        }
    }

    /**
     * @return array
     */
    public function getUser1(): array
    {
        return $this->user1;
    }

    /**
     * @return array
     */
    public function getUser2(): array
    {
        return $this->user2;
    }
}