package swen90006.aqms;

import org.junit.Before;
import org.junit.After;
import org.junit.Test;

import static org.junit.Assert.*;

/**
 * This class is a template for your assignment, designed to help you get started with writing JUnit tests.
 * It sets up the testing environment by creating an instance of the AQMS (Air Quality Management System) class
 * and includes a few example tests to demonstrate how to write and structure your JUnit tests.
 */
public class PartitioningTests {
    // The AQMS instance variable aqms is shared across all test methods in this class
    protected AQMS aqms;

    /**
     * The setup method annotated with "@Before" runs before each test.
     * It initializes the AQMS instance and creates a dummy user.
     * Use this method to set up any common test data or state.
     */
    @Before
    public void setUp()
            throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        // Initialize the AQMS instance and create a dummy user. This setup runs before each test
        aqms = new AQMS();
        aqms.register("UserNameA", "Password1!", "1234");
    }

    /**
     * The teardown method annotated with "@After" runs after each test.
     * It's useful for cleaning up resources or resetting states.
     * Currently, this method doesn't perform any actions, but you can customize it as needed.
     */
    @After
    public void tearDown() {
        // No resources to clean up in this example, but this is where you would do so if needed
    }

    // ADD YOUR TESTS HERE
    // This is the section where you will add your own tests.

    // register 方法测试
    // 测试有效用户名、有效密码、有效设备ID的注册
    @Test
    public void testValidRegistration() throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        aqms.register("ValidUser", "ValidPass1!", "1234");
        assertTrue(aqms.isUser("ValidUser"));
    }

    // 测试无效用户名（少于4个字符）
    @Test(expected = InvalidUsernameException.class)
    public void testInvalidUsernameShort() throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        aqms.register("Usr", "ValidPass1!", "1234");
    }

    // 测试无效密码（少于8个字符）
    @Test(expected = InvalidPasswordException.class)
    public void testInvalidPasswordShort() throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        aqms.register("ValidUser", "Pass1!", "1234");
    }

    // 测试无效设备ID（长度不等于4）
    @Test(expected = InvalidDeviceIDException.class)
    public void testInvalidDeviceIDLength() throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        aqms.register("ValidUser", "ValidPass1!", "12345");
    }

    // 测试重复用户名
    @Test(expected = DuplicateUserException.class)
    public void testDuplicateUser() throws DuplicateUserException, InvalidUsernameException, InvalidPasswordException, InvalidDeviceIDException {
        aqms.register("UserNameA", "ValidPass1!", "1234");  // UserNameA 已经在 setup() 中注册过
    }

    // login方法测试
    // 测试成功登录
    @Test
    public void testValidLogin() throws NoSuchUserException, IncorrectPasswordException, IncorrectDeviceIDException {
        assertEquals("AUTHENTICATED", aqms.login("UserNameA", "Password1!", "1234"));
    }

    // 测试无效用户名
    @Test(expected = NoSuchUserException.class)
    public void testInvalidUsernameLogin() throws NoSuchUserException, IncorrectPasswordException, IncorrectDeviceIDException {
        aqms.login("NonExistentUser", "Password1!", "1234");
    }

    // 测试无效密码
    @Test(expected = IncorrectPasswordException.class)
    public void testIncorrectPasswordLogin() throws NoSuchUserException, IncorrectPasswordException, IncorrectDeviceIDException {
        aqms.login("UserNameA", "WrongPass1!", "1234");
    }

    // 测试无效设备ID
    @Test(expected = IncorrectDeviceIDException.class)
    public void testIncorrectDeviceIDLogin() throws NoSuchUserException, IncorrectPasswordException, IncorrectDeviceIDException {
        aqms.login("UserNameA", "Password1!", "5678");
    }


}
