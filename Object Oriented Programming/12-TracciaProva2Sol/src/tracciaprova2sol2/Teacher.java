
package tracciaprova2sol2;

/**
 *
 * @author Chiara
 */
public class Teacher extends Person {

    private final TeacherType type;

    public TeacherType getType() {
        return type;
    }

    public Teacher(String name, String surname, TeacherType type, int year, int month, int dayOfMonth) {
        super(name, surname, year, month, dayOfMonth);
        this.type = type;
    }

    @Override
    public String toString() {
        return super.toString() + "\nType = " + type;
    }

}