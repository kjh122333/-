package net.idsan.idoitnong;

/* *
*
* 08-05 4방향 8방향으로 구분할 수 있게 수정함
* */

public class JoystickDirection {
    public static final int NONE = 0;
    public static final int LEFT = 1;
    public static final int LEFT_UP = 2;
    public static final int UP = 3;
    public static final int RIGHT_UP = 4;
    public static final int RIGHT = 5;
    public static final int RIGHT_DOWN = 6;
    public static final int DOWN = 7;
    public static final int LEFT_DOWN = 8;

    public static int get4Direction(int angle) {
        if(angle > 315 || angle <= 45) return RIGHT;
        else if(angle > 45 && angle <= 135) return UP;
        else if(angle > 135 && angle <= 235) return LEFT;
        else if(angle > 235 && angle <= 315) return DOWN;
        return NONE;
    }

    public static int get8Direction(int angle) {
        if(angle > 330 || angle <= 30) return RIGHT;
        else if(angle > 30 && angle <= 60) return RIGHT_UP;
        else if(angle > 60 && angle <= 120) return UP;
        else if(angle > 120 && angle <= 150) return LEFT_UP;
        else if(angle > 150 && angle <= 210) return LEFT;
        else if(angle > 210 && angle <= 240) return LEFT_DOWN;
        else if(angle > 240 && angle <= 300) return DOWN;
        else if(angle > 300 && angle <= 330) return RIGHT_DOWN;
        return NONE;
    }
}
