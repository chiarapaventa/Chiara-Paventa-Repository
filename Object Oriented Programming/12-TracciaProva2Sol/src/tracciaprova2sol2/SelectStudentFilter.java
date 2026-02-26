/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package tracciaprova2sol2;

/**
 *
 * @author Chiara
 */
public class SelectStudentFilter implements PersonFilter {

    @Override
    public boolean checkPerson(Person p) {
        return p instanceof Student;
    }

}
